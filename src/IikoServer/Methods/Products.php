<?php


namespace IikoServer\Api\Methods;


use IikoServer\Api\Exceptions\IikoApiException;
use IikoServer\Api\IikoRequests;
use IikoServer\Api\Objects\ProductObject;
use IikoServer\Api\Objects\ProductsContainersObject;

trait Products
{

    use IikoRequests;

    /**
     *
     * Gets array of products according to the specified conditions
     *
     * <code>
     * $params = [
     *   'includeDeleted'              => true|false,
     *   'ids'                         => [],
     *   'nums'                        => [],
     *   'types'                       => [],
     * ];
     * </code>
     *
     * @param array    $params  [
     *
     * @var bool $includeDeleted Include deleted products in result array (true or false), default true
     * @var array $ids Array identifiers of products
     * @var array $nums Array articles of products
     * @var array $types Array types of products
     *
     * ]
     *
     * @return array
     */
    public function getProducts(array $params = []) {

        $includeDeleted = $this->validateincludeDeleted($params);
        $ids = $this->validateIds($params);
        $nums = $this->validateNums($params);
        $types = $this->validateTypes($params);

        $result = $this->request($this->products_endpoint, $this->key, 'GET', [], $includeDeleted.''.$ids.''.$nums.''.$types);

        $productsArray = [];
        $i = 0;
        foreach (json_decode($result, true) as $item) {
            $productsArray[] = new ProductObject(
                $item['id'],
                $item['deleted'],
                $item['name'],
                $item['description'],
                $item['num'],
                $item['code'],
                $item['taxCategory'],
                $item['category'],
                $item['accountingCategory'],
                $item['mainUnit'],
                $item['type'],
                $item['unitWeight'],
                $item['unitCapacity'],
            );
            if (count($item['containers']) > 0){
                foreach ($item['containers'] as $cont){
                    $productsArray[$i]->containers[] = new ProductsContainersObject(
                        $cont['id'],
                        $cont['num'],
                        $cont['name'],
                        $cont['count'],
                        $cont['minContainerWeight'],
                        $cont['maxContainerWeight'],
                        $cont['containerWeight'],
                        $cont['fullContainerWeight'],
                        $cont['deleted'],
                        $cont['useInFront'],
                    );
                }
            }

            $i++;
        }

        return $productsArray;

    }

    /**
     * @param $params
     * @return string
     * @throws IikoApiException
     */
    private function validateincludeDeleted($params) : string {
        if (array_key_exists('includeDeleted', $params) && !is_bool($params['includeDeleted'])){
            throw IikoApiException::incorrectBool('Parameter IncludeDeleted should be bool');
        } elseif (array_key_exists('includeDeleted', $params) && is_bool($params['includeDeleted'])){
            $res = $params['includeDeleted'] ? 'true' : 'false';
            return "&includeDeleted=".$res;
        } else {
            return "&includeDeleted=true";
        }
    }

    /**
     * @param $params
     * @return string
     */
    private function validateIds($params) : string {
        if (array_key_exists('ids', $params) && count($params['ids']) > 0){
            $que = "";
            foreach ($params['ids'] as $id){
                $que .= "&ids=".$id;
            }

            return $que;
        } else {
            return "";
        }
    }

    /**
     * @param $params
     * @return string
     */
    private function validateNums($params) : string {
        if (array_key_exists('nums', $params) && count($params['nums']) > 0){
            $que = "";
            foreach ($params['nums'] as $num){
                $que .= "&nums=".$num;
            }

            return $que;
        } else {
            return "";
        }
    }

    /**
     * @param $params
     * @return string
     */
    private function validateTypes($params) : string {
        if (array_key_exists('types', $params) && count($params['types']) > 0){
            $que = "";
            foreach ($params['types'] as $type){
                $que .= "&types=".$type;
            }

            return $que;
        } else {
            return "";
        }
    }
}
