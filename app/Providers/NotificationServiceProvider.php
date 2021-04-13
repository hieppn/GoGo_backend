<?php

			namespace App\Providers;

			Use Schema;
			use Illuminate\Support\ServiceProvider;
			use App\Contracts\NotificationInterface;
			use App\Services\FcmService;

			class NotificationServiceProvider extends ServiceProvider
			{
				protected $defer = true;

				public function boot()
				{
					//
				}

				public function register()
				{
					$this->app->bind(NotificationInterface::class, function(){
						return new FcmService();
					});
				}
			}
			