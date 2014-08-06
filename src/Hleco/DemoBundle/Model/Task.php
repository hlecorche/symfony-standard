<?php

namespace Hleco\DemoBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @Assert\GroupSequence({"Task", "After"})
 */
class Task
{
    protected $name;

    /**
     * @Assert\Callback()
     */
    public function validate1(ExecutionContextInterface $context)
    {
        //Message displayed
        $context->buildViolation('Error !')
            ->atPath('name')
            ->addViolation();

        $context->getValidator()
            ->inContext($context)
            ->atPath('name')
            ->validate(
                $this->name,
                new Assert\NotBlank() //Error message never displayed !!!
            );
    }

    /**
     * @Assert\Callback(groups={"After"})
     */
    public function validate2(ExecutionContextInterface $context)
    {
        //...
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}