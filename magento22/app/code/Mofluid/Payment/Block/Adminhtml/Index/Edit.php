<?php
namespace Mofluid\Payment\Block\Adminhtml\Index;

/**
 * CMS block edit form container
 */
class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    protected function _construct()
    {
		$this->_objectId = 'id';
        $this->_blockGroup = 'Mofluid_Payment';
        $this->_controller = 'adminhtml_index';

        parent::_construct();

        $this->buttonList->remove('save', 'label', __('Save Block'));
        $this->buttonList->remove('delete', 'label', __('Delete Block'));
        $this->buttonList->remove('reset', 'label', __('Reset'));
        $this->buttonList->remove('back', 'label', __('Back'));
        $this->buttonList->add(
            'saveandcontinue',
            array(
                'label' => __('Save'),
                'class' => 'save primary',
                'data_attribute' => array(
                    'mage-init' => array('button' => array('event' => 'saveAndContinueEdit', 'target' => '#edit_form'))
                )
            ),
            -100
        );

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('block_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'hello_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'hello_content');
                }
            }
        ";
    }

    /**
     * Get edit form container header text
     *
     * @return string
     */
    public function getHeaderText()
    {
        if ($this->_coreRegistry->registry('checkmodule_checkmodel')->getId()) {
            return __("Edit Item '%1'", $this->escapeHtml($this->_coreRegistry->registry('checkmodule_checkmodel')->getTitle()));
        } else {
            return __('New Item');
        }
    }
}
