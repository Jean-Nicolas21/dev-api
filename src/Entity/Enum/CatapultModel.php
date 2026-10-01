<?php

namespace App\Entity\Enum;

enum CatapultModel: string
{
    case OnagreM3 = 'Onagre M3';
    case BalisteXR = 'Baliste XR';
    case Mangonneau700 = 'Mangonneau 700';

    # Return the franchise for the baggage, is that to say the maximum weight the baggage deppending on the Catapult Model, the weight is expressed in Kilogramms.
    public function maxBaggageWeightKg(CatapultModel $catapultModel): int
    {
        return match ($this){
            CatapultModel::OnagreM3 =>23,
            CatapultModel::BalisteXR =>15,
            CatapultModel::Mangonneau700 =>32,
        };
    }
}
