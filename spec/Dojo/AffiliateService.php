<?php

namespace spec\Dojo;

use PHPSpec2\ObjectBehavior;

class AffiliateService extends ObjectBehavior
{
    public function let($repository)
    {
        $repository->beAMockOf('Dojo\AffiliateRepository');
        $this->beConstructedWith($repository);
    }

    public function it_should_pass_the_given_data_to_the_repository_to_create_an_affiliate($data, $repository)
    {
        $repository->create($data)->shouldBeCalled();
        $this->createAffiliate($data);
    }

    public function it_should_pass_the_given_affiliateId_to_the_repository_to_retrieve_an_affiliate($affiliateId, $repository)
    {
        $repository->retrieveByAffiliateId($affiliateId)->shouldBeCalled();
        $this->retrieveAffiliate($affiliateId);
    }

    public function it_should_pass_the_affiliate_to_the_repository_to_update_an_affiliate($affiliate, $repository)
    {
        $repository->update($affiliate)->shouldBeCalled();
        $this->updateAffiliate($affiliate);
    }

    public function it_should_pass_the_affiliateId_to_the_repository_to_delete_an_affiliate($affiliateId, $repository)
    {
        $repository->delete($affiliateId)->shouldBeCalled();
        $this->deleteAffiliate($affiliateId);
    }

}
