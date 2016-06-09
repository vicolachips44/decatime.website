<?php

namespace Org\Decatime\Controller;

use Slim\Http\Request;
use Slim\Http\Response;

class PrivateController extends AbstractController
{
    /**
     * loginAction handler.
     *
     * {@inheritdoc}
     */
    public function loginAction(Request $request, Response $response)
    {
        $data = $request->getParsedBody();
        if (count($data) === 0) {
            $this->session->set('admin-auth', false);
            return $response->withJson(['status' => 'OK'], 200);
        }
        $respData = ['status' => 'KO'];
        $status = 403;
        if ($data['login'] === 'admin' && $data['pwd'] === getenv('ADM_PWD')) {
            $respData['status'] = 'OK';
            $status = 200;
            $this->session->set('admin-auth', true);
        }
        return $response->withJson($respData, $status);
    }

    /**
     * adminAction handler.
     *
     * {@inheritdoc}
     */
    public function adminAction(Request $request, Response $response)
    {
        return $this->render($response, 'admin.html.twig', [
            'page_title' => 'Administration site'
        ]);
    }
}
