<?php
 namespace tk\GuzzleHttp\Promise; final class Is { public static function pending(\tk\GuzzleHttp\Promise\PromiseInterface $promise) { return $promise->getState() === \tk\GuzzleHttp\Promise\PromiseInterface::PENDING; } public static function settled(\tk\GuzzleHttp\Promise\PromiseInterface $promise) { return $promise->getState() !== \tk\GuzzleHttp\Promise\PromiseInterface::PENDING; } public static function fulfilled(\tk\GuzzleHttp\Promise\PromiseInterface $promise) { return $promise->getState() === \tk\GuzzleHttp\Promise\PromiseInterface::FULFILLED; } public static function rejected(\tk\GuzzleHttp\Promise\PromiseInterface $promise) { return $promise->getState() === \tk\GuzzleHttp\Promise\PromiseInterface::REJECTED; } } 