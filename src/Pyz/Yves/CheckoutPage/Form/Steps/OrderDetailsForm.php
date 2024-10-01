<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Yves\CheckoutPage\Form\Steps;

use Spryker\Yves\Kernel\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class OrderDetailsForm extends AbstractType
{
    protected const FIELD_ORDER_NAME = 'orderName';

    protected const GLOSSARY_PAGE_CHECKOUT_ORDER_DETAILS_ORDER_NAME_LABEL = 'page.checkout.order_details.order_name.label';

    protected const GLOSSARY_VALIDATION_NOT_BLANK_MESSAGE = 'validation.not_blank';

    protected const GLOSSARY_VALIDATION_ONLY_LETTERS_AND_DIGITS = 'validation.lower_case_letters_and_digits_only';

    protected const GLOSSARY_VALIDATION_LENGTH_MIN = 'validation.min_length';

    protected const GLOSSARY_VALIDATION_LENGTH_MAX = 'validation.max_length';


    public function getBlockPrefix(): string
    {
        return 'orderDetailsForm';
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array<string, mixed> $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $this->addOrderNameSubForm($builder, $options);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array<string, mixed> $options
     *
     * @return $this
     */
    protected function addOrderNameSubForm(FormBuilderInterface $builder, array $options): self
    {
        $fieldOptions = [
            'required' => true,
            'label' => static::GLOSSARY_PAGE_CHECKOUT_ORDER_DETAILS_ORDER_NAME_LABEL,
            'sanitize_xss' => true,
            'constraints' => [
                $this->createNotBlankConstraint($options),
                $this->createRegexpConstraint($options),
                $this->creteLengthConstraint($options),
            ],
        ];

        $builder->add(static::FIELD_ORDER_NAME, TextType::class, $fieldOptions);

        return $this;
    }

    /**
     * @param array<string, mixed> $options
     *
     * @return \Symfony\Component\Validator\Constraints\NotBlank
     */
    protected function createNotBlankConstraint(array $options): NotBlank
    {
        return new NotBlank(['message' => static::GLOSSARY_VALIDATION_NOT_BLANK_MESSAGE]);
    }

    /**
     * @param array<string, mixed> $options
     *
     * @return \Symfony\Component\Validator\Constraints\Regex
     */
    protected function createRegexpConstraint(array $options): Regex
    {
        return new Regex([
            'pattern' => '/^[a-z0-9]+$/',
            'message' => static::GLOSSARY_VALIDATION_ONLY_LETTERS_AND_DIGITS,
        ]);
    }

    /**
     * @param array<string, mixed> $options
     *
     * @return \Symfony\Component\Validator\Constraints\Length
     */
    public static function creteLengthConstraint(array $options): Length
    {
        return new Length([
            'min' => 5,
            'max' => 30,
            'minMessage' => static::GLOSSARY_VALIDATION_LENGTH_MIN,
            'maxMessage' => static::GLOSSARY_VALIDATION_LENGTH_MAX,
        ]);
    }
}
