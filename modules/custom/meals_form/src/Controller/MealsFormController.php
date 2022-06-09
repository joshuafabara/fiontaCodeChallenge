<?php
namespace Drupal\meals_form\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Provides route responses for the Example module.
 */
class MealsFormController extends ControllerBase {

  /**
   * Returns a simple page.
   *
   * @return array
   *   A simple renderable array.
   */
  public function mealsSummary() {
    $mealsArray = array();
    \Drupal::service('page_cache_kill_switch')->trigger(); // Avoid caching the page as it should change with every form submission.

    $webform_machinename = 'meals_form';
    $form = \Drupal::entityTypeManager()->getStorage('webform')->load($webform_machinename);

    if (isset($form)) {
      $formArray = \Drupal::entityTypeManager()
        ->getViewBuilder('webform')
        ->view($form);
      $mealsArrayIndex = 0;
      $query = \Drupal::entityQuery('webform_submission')
        ->condition('webform_id', 'meals_form');
      $result = $query->execute(); // Gives me IDs associated with the "meals_form" webform.

      $storage = \Drupal::entityTypeManager()->getStorage('webform_submission');
      $submissions = $storage->loadMultiple($result);

      if (count($submissions)) {
        foreach ($formArray['elements']['type_of_meal']['#options'] as $key => $mealType) {
          if ($key > 0) { // Skipping first option as it is the empty option.
            $mealsArray[$mealType] = 0;
          }
        }

        foreach ($submissions as $submission) {
          $submission_data = $submission->getData();
          $mealsArray[ucwords($submission_data['type_of_meal'])]++; // Adding one more meal to the submission selected meal type.
        }
      }
    }

    return [
      '#theme' => 'meals_summary',
      '#meals' => $mealsArray,
    ];
  }

}
