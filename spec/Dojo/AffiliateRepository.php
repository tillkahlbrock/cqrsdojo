<?php

namespace spec\Dojo;

use PHPSpec2\ObjectBehavior;

class AffiliateRepository extends ObjectBehavior
{
    public function it_should_create_an_affiliate()
    {
        $affiliate = $this->create(array('id' => 1234));
        $affiliate->shouldHaveType('Dojo\Affiliate');
    }

    public function it_should_create_an_affiliate_with_the_given_data()
    {
        $name = 'Paul Müller';
        $country = 'DE';

        $data = array(
            'id' => 1234,
            'name' => $name,
            'country' => $country
        );

        $affiliate = $this->createAffiliate($data);
        $affiliate->getName()->shouldBe($name);
        $affiliate->getCountry()->shouldBe($country);
    }

    /**
     * @param $data
     * @return \Dojo\Affiliate
     */
    private function createAffiliate($data)
    {
        return $this->create($data);
    }

    public function it_should_retrieve_an_affiliate()
    {
        $affiliateId = 123;

        $affiliate = $this->createAffiliate(array('id' => $affiliateId));

        $this->retrieve($affiliateId)->shouldReturn($affiliate);
    }
}