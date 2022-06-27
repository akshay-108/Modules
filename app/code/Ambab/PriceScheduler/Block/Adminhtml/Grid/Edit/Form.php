<?php

namespace Ambab\PriceScheduler\Block\Adminhtml\Grid\Edit;

/**
 * Adminhtml Add New Row Form.
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry             $registry
     * @param \Magento\Framework\Data\FormFactory     $formFactory
     * @param array                                   $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Ambab\PriceScheduler\Model\Status $options,
        array $data = []
    ) {
        $this->_options = $options;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form.
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        // $dateFormat = $this->_localeDate->getDateFormat(\IntlDateFormatter::SHORT);
        $model = $this->_coreRegistry->registry('row_data');
        $form = $this->_formFactory->create(
            [
                'data' => [
                    'id' => 'edit_form',
                    'enctype' => 'multipart/form-data',
                    'action' => $this->getData('action'),
                    'method' => 'post'
                ]
            ]
        );

        $form->setHtmlIdPrefix('wkgrid_');
        if ($model->getEntityId()) {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Edit Row Data'), 'class' => 'fieldset-wide']
            );
            $fieldset->addField('id', 'hidden', ['name' => 'id']);
        } else {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Add Schedule'), 'class' => 'fieldset-wide']
            );
        }

        $fieldset->addField(
            'start_time',
            'date',
            [
                'name' => 'start_time',
                'label' => __('Start Time and Date'),
                'id' => 'start_time',
                'title' => __('Start Time and Date'),
                'class' => 'required-entry',
                'required' => true,
                'date_format' => 'yyyy-MM-dd',
                'time_format' => 'hh:mm:ss'
            ]
        );
        $fieldset->addField(
            'product_data',
            'file',
            [
                'name' => 'product_data',
                'label' => __('Product Data'),
                'id' => 'product_data',
                'title' => __('Product Data'),
                'required' => true,
            ]
        );
        // $importdata_script->setAfterElementHtml(
        //     "<script type=\"text/javascript\">

        //     document.getElementById('[route_name]_importdata').onchange = function () { 

        //         var fileInput = document.getElementById('[route_name]_importdata');

        //         var filePath = fileInput.value;

        //         var allowedExtensions = /(\.csv|\.xls)$/i; 

        //         if(!allowedExtensions.exec(filePath))
        //         {
        //             alert('Please upload file having extensions .csv or .xls only.');
        //             fileInput.value = '';
        //         }

        //     };

        //     </script>"
        // );

        $fieldset->addField(
            'is_applied',
            'select',
            [
                'name' => 'is_applied',
                'label' => __('Is Applied'),
                'id' => 'is_applied',
                'title' => __('Is Applied'),
                'values' => $this->_options->getOptionArray(),
                'required' => true,
            ]
        );
        $fieldset->addField(
            'is_disabled',
            'select',
            [
                'name' => 'is_disabled',
                'label' => __('Is Disabled'),
                'id' => 'is_disabled',
                'title' => __('Is Disabled'),
                'values' => $this->_options->getOptionArray(),
                'required' => true,
            ]
        );

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
