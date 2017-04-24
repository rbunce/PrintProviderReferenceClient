<?php


class UpdateTest extends \PHPUnit_Framework_TestCase
{
    public function testUpdate()
    {
        $update = new PrintProviderReferenceClient_Receive_Update(new PrintProviderReferenceClient_Validator_ReceiveUpdateValidator(), new PrintProviderReferenceClient_Processor_NullProcessor());

        $json = file_get_contents(__DIR__ . '/../Resources/json/update.json');

        $response = $update->Receive(1, $json);
        $this->assertEquals('', $update->getErrorMessage());
        $this->assertEquals(true, $response);

    }

    public function testUpdateFail()
    {
        $update = new PrintProviderReferenceClient_Receive_Update(new PrintProviderReferenceClient_Validator_ReceiveUpdateValidator(), new PrintProviderReferenceClient_Processor_NullProcessor());

        $json = file_get_contents(__DIR__ . '/../Resources/json/updateFailure.json');

        $response = $update->Receive(1, $json);
        $this->assertNotEquals('', $update->getErrorMessage());
        $this->assertEquals(false, $response);
    }
}