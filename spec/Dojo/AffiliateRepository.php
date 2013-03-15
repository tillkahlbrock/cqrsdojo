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

        $affiliate = $this->create($data);
        $affiliate->getName()->shouldBe($name);
        $affiliate->getCountry()->shouldBe($country);
    }

    public function it_should_retrieve_an_affiliate()
    {
        $affiliateId = 123;

        $affiliate = $this->create(array('id' => $affiliateId));

        $this->retrieve($affiliateId)->shouldBeLike($affiliate);
    }

    public function it_should_update_the_affiliate_with_the_given_data()
    {
        $affiliateId = 1234;

        $data = array(
            'id' => $affiliateId,
            'name' => 'some name',
            'country' => 'some country'
        );

        $affiliate = $this->create($data);

        $affiliate->setName('Bob');
        $affiliate->setCountry('US and A');

        $this->update($affiliate);

        $this->retrieve($affiliateId)->shouldBeLike($affiliate);
    }

    public function it_should_delete_an_affiliate()
    {
        $affiliateId = 12345;

        $this->create(array('id' => $affiliateId));

        $this->delete($affiliateId);

        $this->retrieve($affiliateId)->shouldBe(null);
    }

}