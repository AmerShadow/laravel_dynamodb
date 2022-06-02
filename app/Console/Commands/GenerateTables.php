<?php

namespace App\Console\Commands;

use App\Models\Form;
use BaoPham\DynamoDb\Facades\DynamoDb;
use Illuminate\Console\Command;

class GenerateTables extends Command
{
    private $client;
    private $config = [];
    private $tableName;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for generating all the tables is dynamo DB';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->tableName = with(new Form())->getTable();
        $this->client=DynamoDb::client();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $schema = [
            "AttributeDefinitions" => [
                [
                    "AttributeName" => "id",
                    "AttributeType" => "S"
                ]
            ],
            "TableName" => $this->tableName,
            "KeySchema" => [
                [
                    "AttributeName" => "id",
                    "KeyType" => "HASH"
                ]
            ],
            "ProvisionedThroughput" => [
                "ReadCapacityUnits" => 1,
                "WriteCapacityUnits" => 1
            ]
        ];

        try {
            $x=$this->client->listTables()->get('TableNames');
            $table = $this->client->createTable($schema);

        } catch (\Throwable $th) {
            $th->getMessage();
        }
    }
}
