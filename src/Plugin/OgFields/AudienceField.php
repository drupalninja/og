<?php

namespace Drupal\og\Plugin\OgFields;

use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\og\OgFieldBase;
use Drupal\og\OgFieldsInterface;

/**
 * Redirects to a message deletion form.
 *
 * @OgFields(
 *  id = OG_AUDIENCE_FIELD,
 *  type = "group",
 *  description = @Translation("Determine to which groups this group content is assigned to."),
 * )
 */
class AudienceField extends OgFieldBase implements OgFieldsInterface {

  /**
   * {@inheritdoc}
   */
  public function getFieldStorageConfigBaseDefinition() {
    return [
      'cardinality' => FieldStorageDefinitionInterface::CARDINALITY_UNLIMITED,
      'custom_storage' => TRUE,
      'entity_type' => $this->getEntityType(),
      'field_name' => $this->getFieldName(),
      'settings' => [
        'handler' => 'og',
        'handler_submit' => 'Change handler',
        'handler_settings' => [
          'behaviors' => [
            'og_behavior' => [
              'status' => TRUE,
            ],
          ],
          'target_bundles' => [],
          'membership_type' => OG_MEMBERSHIP_TYPE_DEFAULT,
        ],
        'target_type' => $this->getEntityType(),
      ],
      'type' => 'og_membership_reference',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFieldConfigBaseDefinition(array $instance = []) {
    return [
      'bundle' => $this->getBundle(),
      'description' => $this->t('OG group audience reference field.'),
      'display_label' => TRUE,
      'field_name' => $this->getFieldName(),
      'label' => $this->t('Groups audience'),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function widgetDefinition(array $widget = []) {
    // Keep this until og_complex widget is back.
    return [
      'type' => 'og_complex',
      'settings' => [
        'match_operator' => 'CONTAINS',
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function viewModesDefinition(array $view_mode = []) {
    return [
      'default' => [
        'label' => 'above',
        'type' => 'entity_reference_label',
        'settings' => [
          'link' => TRUE,
        ]
      ],
      'teaser' => [
        'label' => 'above',
        'type' => 'entity_reference_label',
        'settings' => [
          'link' => TRUE,
        ],
      ],
    ];
  }
}
