<?php

			namespace App\Contracts;

			interface NotificationInterface
			{
				public function sendBatchNotification($deviceTokens, $data);

				public function sendNotification($data, $topicName);

				public function subscribeTopic($deviceTokens, $topicName);

				public function unsubscribeTopic($deviceTokens, $topicName);
			}
