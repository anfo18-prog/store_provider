<?php

namespace app\models\definitions;

/**
 * @SWG\Definition(required={"date", "sku", "price", "offer_id"})
 *
 * @SWG\Property(property="sku", type="string")
 * @SWG\Property(property="date", type="string")
 * @SWG\Property(property="price", type="number")
 * @SWG\Property(property="offer_id", type="integer")
 */
class Sell
{
}