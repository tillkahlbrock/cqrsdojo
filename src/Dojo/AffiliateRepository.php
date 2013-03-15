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

        $this->storeAffiliate($id, $affiliate);

        return $affiliate;
    }

    public function retrieve($affiliateId)
    {
        if (isset($this->storage[$affiliateId])) {
            return $this->storage[$affiliateId];
        }

        return null;
    }

    public function update(Affiliate $affilate)
    {
        $this->storeAffiliate($affilate->getId(), $affilate);
    }

    public function delete($affiliateId)
    {
        if (isset($this->storage[$affiliateId])) {
            unset($this->storage[$affiliateId]);
        }
    }

    private function storeAffiliate($id, $affiliate)
    {
        $this->storage[$id] = clone($affiliate);
    }
}
