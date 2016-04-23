<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Image Manager</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-5">
                    <button type="button" data-toggle="tooltip" title="Upload" id="button-upload" class="btn btn-primary"><i class="fa fa-upload"></i></button>
                    <button type="button" data-toggle="tooltip" title="New Folder" id="button-folder" class="btn btn-default"><i class="fa fa-folder"></i></button>
                    <button type="button" data-toggle="tooltip" title="Delete" id="button-delete" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                </div>
                <div class="col-sm-7">
                    <ol class="breadcrumb">
                        @foreach ($breadcrumbs as $path => $disp)
                        <li><a class="directory" href="/admin/filemanager?folder={{ $path }}">{{ $disp }}</a></li>
                        @endforeach
                        <li class="active">{{ $folderName }}</li>
                    </ol>
                </div>
            </div>
            <hr />
            <div class="row">
                @foreach($files as $file)
                <div class="col-md-2 col-sm-3 col-xs-6 image-thumb">
                    @if(!$file['is_file'])
                    <a href="{{ route('admin.filemanager.index', ['folder' => $file['localPath']])}}" class="directory"><i class="fa fa-folder"></i></a>
                    @else
                    <a href="" class="thumbnail">
                        <img src="{{ $file['thumb'] }}" alt="{{ $file['name'] }}" title="{{ $file['name'] }}" />
                    </a>
                    @endif
                    <div class="checkbox"><label><input type="checkbox" name="path[]" value="{{ $file['localPath'] }}" />{{ $file['name'] }}</label></div>
                </div>
                @endforeach
                @if(empty($files))
                    <div class="col-xs-12"><div class="alert alert-info">Folder empty</div></div>
                @endif
            </div>
            <br />
        </div>
    </div>
</div>

<script type="text/javascript">
var CURRENT_FOLDER = "{{ $folder }}";
var REFRESH_URL = "{{ route('admin.filemanager.index', ['folder' => $folder]) }}";
$('a.thumbnail').on('click', function(e) {
    e.preventDefault();

    $('#{{ $thumb }}').find('img').attr('src', $(this).find('img').attr('src'));
    $('#{{ $thumb }}').siblings('input').val($(this).parent().find('input').attr('value'));

    /*var range, sel = window.getSelection();

    if (sel.rangeCount) {
        var img = document.createElement('img');
        img.src = $(this).attr('href');

        range = sel.getRangeAt(0);
        range.insertNode(img);
    }*/

    $('#modal-image').modal('hide');
});

$('a.directory').on('click', function(e) {
    e.preventDefault();

    $('#modal-image').load($(this).attr('href'));
});

$('.pagination a').on('click', function(e) {
    e.preventDefault();
    $('#modal-image').load($(this).attr('href'));
});
</script>
<script type="text/javascript">


$('#button-upload').on('click', function() {
    $('#form-upload').remove();

    $('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="hidden" name="folder" value="{{ $folder }}"/><input type="file" name="file" /></form>');

    $('#form-upload input[name=\'file\']').trigger('click');

    $('#form-upload input[name=\'file\']').on('change', function() {
        $.ajax({
            url: "{{ route('admin.filemanager.store') }}",
            type: 'post',
            dataType: 'json',
            data: new FormData($(this).parent()[0]),
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('#button-upload i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
                $('#button-upload').prop('disabled', true);
            },
            complete: function() {
                $('#button-upload i').replaceWith('<i class="fa fa-upload"></i>');
                $('#button-upload').prop('disabled', false);
            },
            success: function(json) {
                if (json['error']) {
                    alert(json['error']);
                }

                if (json['success']) {
                    $('#modal-image').load(REFRESH_URL);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    });
});

$('#button-folder').popover({
    html: true,
    placement: 'bottom',
    trigger: 'click',
    title: 'Folder Name',
    content: function() {
        html = '<div class="input-group">';
        html += '  <input type="text" name="new_folder" value="" placeholder="Folder Name" class="form-control">';
        html += '  <span class="input-group-btn"><button type="button" title="New Folder" id="button-create" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></span>';
        html += '</div>';
        return html;
    }
});

$('#button-folder').on('shown.bs.popover', function() {
    $('#button-create').on('click', function() {
        $.ajax({
            url: "{{ route('admin.filemanager.folder') }}",
            type: 'post',
            dataType: 'json',
            data: 'new_folder=' + encodeURIComponent($('input[name=\'new_folder\']').val()) + "&folder=" + CURRENT_FOLDER,
            beforeSend: function() {
                $('#button-create i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
                $('#button-create').prop('disabled', true);
            },
            complete: function() {
                $('#button-create i').replaceWith('<i class="fa fa-plus-circle"></i>');
                $('#button-create').prop('disabled', false);
            },
            success: function(json) {
                if (json['error']) {
                    alert(json['error']);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    });
});

$('#modal-image #button-delete').on('click', function(e) {
    if ($('input[name^=\'path\']:checked').length > 0 && confirm('Delete cannot be undone! Are you sure you want to do this?')) {
        $.ajax({
            url: "{{ route('admin.filemanager.destroy', 1) }}",
            type: 'DELETE',
            dataType: 'json',
            data: $('input[name^=\'path\']:checked'),
            beforeSend: function() {
                $('#button-delete i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
                $('#button-delete').prop('disabled', true);
            },
            complete: function() {
                $('#button-delete i').replaceWith('<i class="fa fa-trash-o"></i>');
                $('#button-delete').prop('disabled', false);
            },
            success: function(json) {
                if (json['error']) {
                    alert(json['error']);
                }
                if (json['success']) {
                    alert(json['success']);
                    $('#modal-image').load(REFRESH_URL);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }
});
</script>
