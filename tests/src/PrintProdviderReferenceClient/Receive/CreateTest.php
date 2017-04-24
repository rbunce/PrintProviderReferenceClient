<?php


class CreateTest extends \PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $create = new PrintProviderReferenceClient_Receive_Create(new PrintProviderReferenceClient_Validator_ReceiveCreateValidator(), new PrintProviderReferenceClient_Processor_NullProcessor());

        $json = file_get_contents(__DIR__ . '/../Resources/json/create.json');
        print_r($create->getErrorMessage());
        $response = $create->Receive($json);
        $this->assertEquals('', $create->getErrorMessage());
        $this->assertEquals(true, $response);

    }

    public function testCreateFail()
    {
        $create = new PrintProviderReferenceClient_Receive_Create(new PrintProviderReferenceClient_Validator_ReceiveCreateValidator(), new PrintProviderReferenceClient_Processor_NullProcessor());

        $json = file_get_contents(__DIR__ . '/../Resources/json/createFailure.json');
        print_r($create->getErrorMessage());
        $response = $create->Receive($json);
        $this->assertNotEquals('', $create->getErrorMessage());
        $this->assertEquals(false, $response);
    }
}