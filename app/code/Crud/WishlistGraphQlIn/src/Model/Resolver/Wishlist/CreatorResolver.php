<?php

declare(strict_types=1);

namespace Crud\WishlistGraphQlIn\Model\Resolver\Wishlist;

use Magento\Wishlist\Model\Wishlist;
use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Customer\Model\ResourceModel\CustomerRepository;

class CreatorResolver implements ResolverInterface
{
    /**
     * @var CustomerRepository
     */
    protected $customerRepository;

    public function __construct(
        CustomerRepository $customerRepository
    ) {
        $this->customerRepository = $customerRepository;
    }

    /**
     * @inheritdoc
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        /** @var Wishlist $wishlist */
        $wishlist = $value['model'] ?? null;

        if (!$wishlist) {
            return null;
        }

        $customerId = $wishlist->getCustomerId();
        /** @var CustomerInterface $customer */
        $customer = $this->customerRepository->getById($customerId);

        $firstName = $customer->getFirstname();
        $lastName = $customer->getLastname();

        $creatorsName = "$firstName $lastName";

        return $creatorsName;
    }
}
