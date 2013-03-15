<?php

namespace Dojo;

class AffiliateRepository
{
    private $storage = array();

    public function create($data)
    {
        $id = $data['id'];
        $affiliate =  new Affiliate();

        $affiliate->setId($id);

        if (isset($data['name'])) {
            $affiliate->setName($data['name']);
        }

        if (isset($data['country'])) {
            $affiliate->setCountry($data['country']);
        }

        $this->storage[$id] = $affiliate;

        return $affiliate;
    }

    public function retrieve($affiliateId)
    {
        if (isset($this->storage[$affiliateId])) {
            return $this->storage[$affiliateId];
        }

        return null;
    }
}
