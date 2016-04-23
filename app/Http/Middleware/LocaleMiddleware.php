<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Menu;

/**
 * Class LocaleMiddleware
 * @package App\Http\Middleware
 */
class LocaleMiddleware {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure                 $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {
		/**
		 * Locale is enabled and allowed to be changed
		 */
		if (config('locale.status')) {

			if (session()->has('locale') && in_array(session()->get('locale'), array_keys(config('locale.languages')))) {

				/**
				 * Set the Laravel locale
				 */
				app()->setLocale(session()->get('locale'));

				/**
				 * setLocale for php. Enables ->formatLocalized() with localized values for dates
				 */
				setLocale(LC_TIME, config('locale.languages')[session()->get('locale')][1]);

				/**
				 * setLocale to use Carbon source locales. Enables diffForHumans() localized
				 */
				Carbon::setLocale(config('locale.languages')[session()->get('locale')][0]);
			}

		}

		Menu::make('AdminNav', function ($menu) {
			$menu->raw('MAIN NAVIGATION', array('class' => 'header'));
			foreach (\App\Models\Menu\Menu::root()->children()->get() as $item) {
				$li = $menu->add($item->name, $item->url)->active($item->url . '/*');
				if ($item->icon != "") {
					$li->prepend('<i class="' . $item->icon . '"></i>');
				}
				if ($item->children()->count() > 0) {
					$li->append('<i class="fa fa-angle-left pull-right"></i>');
					foreach ($item->children()->get() as $subitem) {
						$li->add($subitem->name, $subitem->url)->prepend('<i class="fa fa-circle-o"></i>');
					}
				}
			}
		});

		return $next($request);
	}
}
