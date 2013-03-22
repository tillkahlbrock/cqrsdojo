<?php

namespace spec\Dojo;

use PHPSpec2\ObjectBehavior;
use Dojo\DatabaseAdapter;
use Dojo\Affiliate;

class AffiliateRepository extends ObjectBehavior
{
    public function let($databaseAdapter)
    {
        $databaseAdapter->beAMockOf('\Dojo\DatabaseAdapter');
        $this->beConstructedWith($databaseAdapter);
    }

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

    /**
     * @param $databaseAdapter \Dojo\DatabaseAdapter
     */
    public function it_should_use_the_database_adapter_to_store_the_affiliate($databaseAdapter)
    {
        $data = array(
            'id' => 1234,
            'name' => 'Paul Müller',
            'country' => 'DE'
        );

        $databaseAdapter->store($data)->shouldBeCalled();
        $this->create($data);
    }

    /**
     * @param $databaseAdapter \Dojo\DatabaseAdapter
     */
    public function it_should_use_the_database_adapter_to_retrieve_the_affiliate($databaseAdapter)
    {
        $id = 1234;

        $databaseAdapter->retrieve($id)->shouldBeCalled();

        $this->retrieve($id);
    }

    /**
     * @param $databaseAdapter \Dojo\DatabaseAdapter
     */
    public function it_should_return_an_affiliate_build_from_the_data_from_the_database($databaseAdapter)
    {
        $affiliateId = 1234;

        $data = array(
        'id' => $affiliateId,
        'name' => 'Paul Müller',
        'country' => 'DE'
        );

        $affiliate = $this->create($data);

        $databaseAdapter->retrieve($affiliateId)->willReturn($data);

        $this->retrieve($affiliateId)->shouldBeLike($affiliate);
    }

    /**
     * @param $databaseAdapter \Dojo\DatabaseAdapter
     */
    public function it_should_use_the_databaseAdapter_to_update_an_affiliate($databaseAdapter)
    {
        $affiliateId = 1234;

        $data = array(
            'id' => $affiliateId,
            'name' => 'Paul Müller',
            'country' => 'DE'
        );

        $affiliate = $this->create($data);

        $databaseAdapter->update($data)->shouldBeCalled();
        $this->update($affiliate);
    }

    /**
     * @param $databaseAdapter \Dojo\DatabaseAdapter
     */
    public function it_should_use_the_databaseAdapter_to_delete_an_affiliate($databaseAdapter)
    {
        $affiliateId = 1234;

        $databaseAdapter->delete($affiliateId)->shouldBeCalled();
        $this->delete($affiliateId);
    }

//    public function it_should_retrieve_an_affiliate()
//    {
//        $affiliateId = 123;
//
//        $affiliate = $this->create(array('id' => $affiliateId));
//
//        $this->retrieve($affiliateId)->shouldBeLike($affiliate);
//    }
//
//    public function it_should_update_the_affiliate_with_the_given_data()
//    {
//        $affiliateId = 1234;
//
//        $data = array(
//            'id' => $affiliateId,
//            'name' => 'some name',
//            'country' => 'some country'
//        );
//
//        $affiliate = $this->create($data);
//
//        $affiliate->setName('Bob');
//        $affiliate->setCountry('US and A');
//
//        $this->update($affiliate);
//
//        $this->retrieve($affiliateId)->shouldBeLike($affiliate);
//    }
//
//    public function it_should_delete_an_affiliate()
//    {
//        $affiliateId = 12345;
//
//        $this->create(array('id' => $affiliateId));
//
//        $this->delete($affiliateId);
//
//        $this->retrieve($affiliateId)->shouldBe(null);
//    }

}