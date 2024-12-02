<?php

class UserRegistry
{
    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize singleton");
    }

    private static function getInstanceHolder()
    {
        static $instance = null;
        if ($instance === null) {
            $instance = new UserRegistry();
        }
        return $instance;
    }

    public static function getInstance(): UserRegistry
    {
        return self::getInstanceHolder();
    }


    public function registerUser(string $username, string $email)
    {
        echo "Usuário registrado: {$username}, Email: {$email}" . PHP_EOL;
    }
}

$registry = UserRegistry::getInstance();
$registry->registerUser('johndoe', 'johndoe@example.com');

// Teste de singleton - sempre será a mesma instância
$anotherRegistry = UserRegistry::getInstance();
var_dump($registry === $anotherRegistry); // true

?>
