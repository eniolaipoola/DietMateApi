<?php

namespace app\components;

use yii\web\Response;

class APIResponse extends Response {

    /**
     * @param $message
     * @param $error
     */
    public function ok($message, $error) {
        $this->setStatusCode(200);
        $this->data = [
            'message' => $message,
            'data' => $error

        ];
        $this->send();
    }

    /**
     * @param $message
     * @param $error
     */
    public function unauthorized($message, $error){
        $this->setStatusCode(401);
        $this->data = [
          'message' => $message,
          'error' => $error
        ];
        $this->send();
    }

    /**
     * @param $message
     * @param array $errors
     */
    public function badRequest($message, $errors = []) {
        $this->setStatusCode(400);
        $this->data = [
            'message' => $message,
            'errors' => $errors
        ];
        $this->send();
    }


    /**
     * @param string $message
     */
    public function notFound($message = ''){
        $this->setStatusCode(404);
        $this->data = [
            'message' => $message
        ];
        $this->send();
    }

    /**
     * @param string $message
     * @param array $errors
     */
    public function internalServerError($message = '', $errors = []) {
        $this->setStatusCode(500);

        $this->data = [
            'message' => $message,
            'errors' => $errors

        ];
        $this->send();
    }
}