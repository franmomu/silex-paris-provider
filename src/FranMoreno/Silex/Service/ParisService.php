<?php

namespace FranMoreno\Silex\Service;

class ParisService
{
    public function getModel($model)
    {
        return \Model::factory($model);
    }
}
