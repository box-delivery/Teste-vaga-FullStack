<?php

namespace DB;

/**
 * Conexão com banco de dados
 */
class DB extends \Medoo\Medoo
{
    /**
     * Recuperando variáveis de ambiente para fazer conexão com o banco de dados
     * 
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $options = [
            'database_type' => $_ENV['DB_CONNECTION'] ?? 'mysql',
            'database_name' => $_ENV['DB_DATABASE'] ?? 'name',
            'server' => $_ENV['DB_HOST'] ?? 'localhost',
            'username' => $_ENV['DB_USERNAME'] ?? 'your_username',
            'password' => $_ENV['DB_PASSWORD'] ?? 'your_password'
        ];

        return parent::__construct( $options );
    }
}