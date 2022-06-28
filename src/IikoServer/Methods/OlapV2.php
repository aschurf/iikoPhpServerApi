<?php


namespace IikoServer\Api\Methods;

use IikoServer\Api\IikoRequests;

trait OlapV2
{

    use IikoRequests;

    /**
     * Return OLAP report JSON
     * https://ru.iiko.help/articles/#!api-documentations/olap-2
     * @param string $body 
     */
    public function getOlapReport($body) : string {

        return $this->olapRequest($this->olap_v2_endpoint, $this->key, 'POST', $body);

    }

}