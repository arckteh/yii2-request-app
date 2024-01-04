<?php


namespace Api;

use \ApiTester;
use app\models\entity\Request;

class RequestCest
{
    private $_request = [
        'name' => 'Customer name',
        'email' => 'customer@exampl.com',
        'message' => 'Customer request message'
    ];

    public function _before(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->haveHttpHeader('Authorization', 'Bearer token_admin');
    }


    public function createRequest(ApiTester $I)
    {
        $I->deleteHeader('Authorization');
        $I->haveHttpHeader('Authorization', 'Bearer token_customer');


        $I->sendPost('/requests', $this->_request);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::CREATED); // 201
        $I->seeResponseIsJson();

        $I->seeResponseContainsJson($this->_request);

        $I->deleteHeader('Authorization');
        $I->haveHttpHeader('Authorization', 'Bearer token_admin');


    }

    public function resolveRequest(ApiTester $I)
    {
        $I->sendPost('/requests', $this->_request);

        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::CREATED); // 202
        $I->seeResponseIsJson();

        list($id) = $I->grabDataFromResponseByJsonPath('$id');

        $newRequest =  [
            'comment' => "Resolve request comment",
            'status' => Request::STATUS_RESOLVED
        ];

        $I->sendPut('/requests/' . $id, $newRequest);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseContainsJson($newRequest);
    }

    public function getRequests(ApiTester $I)
    {
        $arequestsQty = 15;
        $activedRequestsQty = 5;
        for ($i = 0; $i < $arequestsQty; $i++) {
            $request= new Request();
            $request->setAttributes($this->_request);
            if ($i >= $activedRequestsQty) {
                $request->status = Request::STATUS_RESOLVED;
                $request->comment = 'Test comment';
            }
            $request->save();
        }

        $I->sendGet('/requests?status='. Request::STATUS_RESOLVED);
        $I->dontSeeResponseContainsJson(['status' => Request::STATUS_ACTIVE]);

        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
    }

    public function getSingleRequest(ApiTester $I)
    {
        $I->sendPost('/requests', $this->_request);
        list($id) = $I->grabDataFromResponseByJsonPath('$id');
        $I->sendGet('/requests/'.$id);

        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
    }

    public function deleteRequest(ApiTester $I)
    {
        $I->sendPost('/requests', $this->_request);
        list($id) = $I->grabDataFromResponseByJsonPath('$id');
        $I->sendGet('/requests/'.$id);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200


        $I->sendDelete('/requests/'.$id);

        $I->sendGet('/requests/'.$id);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::NOT_FOUND); // 404
    }

}
