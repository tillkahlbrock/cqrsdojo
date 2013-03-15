<?php

namespace Dojo;

class AffiliateService
{
    private $repository;

    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    public function createAffiliate($data)
    {
        $this->repository->create($data);
    }

    public function retrieveAffiliate($affiliateId)
    {
        $this->repository->retrieveByAffiliateId($affiliateId);
    }

    public function updateAffiliate($affiliate)
    {
        $this->repository->update($affiliate);
    }

    public function deleteAffiliate($affiliateId)
    {
        $this->repository->delete($affiliateId);
    }
}
