<?php namespace App\Providers;

use Blade;
use File;
use View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

	public function boot()
	{
		$bgs = File::files(public_path('bg'));
		$bgi = array_rand($bgs);
		$bg = str_replace(public_path(), '', $bgs[$bgi]);
		View::share('background', $bg);

		Blade::extend(function($view, $compiler)
		{
			$pattern = $compiler->createOpenMatcher('price');
			return preg_replace($pattern, '$1<?php echo $2->finalPrice .\' \'. config(\'app.currency\')); ?>', $view);
		});
	}

	public function register()
	{
		$this->app->bind(
			'Illuminate\Contracts\Auth\Registrar',
			'App\Services\Registrar'
		);
	}

}
