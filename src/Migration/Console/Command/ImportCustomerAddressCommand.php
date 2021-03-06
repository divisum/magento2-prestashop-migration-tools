<?php

namespace Mimlab\PrestashopMigrationTool\Console\Command;

use Magento\Framework\ObjectManagerInterface;
use Mimlab\PrestashopMigrationTool\Model\CustomerAddress;
use Mimlab\PrestashopMigrationTool\Model\CustomerAddressFactory;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ImportCustomerAddressCommand
 *
 * @package Mimlab\PrestashopMigrationTool\Console\Command
 */
class ImportCustomerAddressCommand extends ImportCommand
{
    /**
     * Type of migration
     */
    const TYPE_IMPORT = 'customer_address';

    /**
     * @var CustomerAddressFactory
     */
    private $customerAddressFactory;

    /**
     * ImportCustomerCommand constructor.
     *
     * @param CustomerAddressFactory $customerAddressFactory
     * @param ObjectManagerInterface $objectManager
     * @param null $name
     */
    public function __construct(
        CustomerAddressFactory $customerAddressFactory,
        ObjectManagerInterface $objectManager,
        $name = null
    ) {
        $this->customerAddressFactory = $customerAddressFactory;
        parent::__construct($objectManager, $name);
    }

    /**
     * Execute command
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @param bool 
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var CustomerAddress $customerAddress */
        $customerAddress = $this->customerAddressFactory->create();
        if ($dirInputPath = $input->getOption(parent::INPUT_KEY_FLOW_DIR)) {
            $customerAddress->setFlowDir($dirInputPath);
        }
        $customerAddress->execute(self::TYPE_IMPORT, $output);
    }
}
