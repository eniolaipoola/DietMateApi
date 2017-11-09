<?php

namespace app\components;

use yii\web\Response;

class APIResponse extends Response {

    public function ok($message, $error) {
        $this->setStatusCode(200);
        $this->data = [
            'message' => $message,
            'data' => $error

        ];
        $this->send();
    }

    public function unauthorized($message, $error){
        $this->setStatusCode(401);
        $this->data = [
          'message' => $message,
          'error' => $error
        ];
        $this->send();
    }

    public function badRequest($message, $errors = []) {
        $this->setStatusCode(400);
        $this->data = [
            'message' => $message,
            'errors' => $errors
        ];
        $this->send();
    }
}