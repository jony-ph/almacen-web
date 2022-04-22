<?php

    // Imprimir y codificar respuestas
    class Message{

        // Imprime datos
        function printJSON($array){
            echo json_encode($array);
        }

        // Imprime mensaje de éxito
        function success($code, $message){
            echo json_encode(array(
                'status' => 'success',
                'code' => $code,
                'message' => $message
            ));
        }

        // Imprime mensaje de error
        function error($code, $message){
            echo json_encode(array(
                'status' => 'error',
                'code' => $code,
                'message' => $message
            ));
        }

        // Imprime mensaje de advertencia
        function warning($code, $message){
            echo json_encode(array(
                'status' => 'warning',
                'code' => $code,
                'message' => $message
            ));
        }

    }
