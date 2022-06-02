<?php

use App\Models\Form;
use BaoPham\DynamoDb\Facades\DynamoDb;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFromsTable extends Migration
{

    private $client;
    private $config = [];
    private $tableName;
    public function __construct() {
        $this->tableName = with(new Form())->getTable();
        $this->client=DynamoDb::client();
    }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
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
            // $existing_tables=$this->client->listTables()->get('TableNames');

            // if (in_array($existing_tables,$this->tableName)) {
            //     $table = $this->client->createTable($schema);
            // }

            $table = $this->client->createTable($schema);


        } catch (\Throwable $th) {
            $th->getMessage();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        try {
            $this->client->deleteTable([
                "TableName" => $this->tableName,
            ]);
        } catch (\Throwable $th) {
            $th->getMessage();
        }

    }
}
