<?php if (!FrameworkConstants_ExecutionAccessRestriction) { exit('No direct script access allowed'); } ?>

<div id="tab-container" class="tab-container">
  <ul class="etabs">
    <li class="tab <?php echo $tab[\Applications\EasyMvc\Resources\Enums\TaskTabKeys::CompleteInfoTab]; ?>" data-form-id="task_status">
      <a href="<?php echo FrameworkConstants_BaseUrl . \Applications\EasyMvc\Helpers\TaskHelper::GetTaskInfoTabUrl($current_task_status); ?>">
        <?php echo $resx["task_tab_info"]; ?>
      </a>
    </li>
    <li class="tab <?php echo $tab[\Applications\EasyMvc\Resources\Enums\TaskTabKeys::CompleteTaskMapTab]; ?>" data-form-id="live_task_map">
      <a href="<?php echo FrameworkConstants_BaseUrl . \Library\Enums\UrlKeys::CompleteTaskMap; ?>">
        <?php echo $resx["task_tab_map"]; ?>
      </a>
    </li>
    <li class="tab <?php echo $tab[\Applications\EasyMvc\Resources\Enums\TaskTabKeys::CompleteInspFormsTab]; ?>" id="tab2" data-form-id="live_task_insp_info">
      <a href="<?php echo FrameworkConstants_BaseUrl . \Library\Enums\UrlKeys::CompleteTaskInspForms; ?>">
        <?php echo $resx["task_tab_forms"]; ?>
      </a>
    </li> 
<!--    Note: The COC, if =used, is not just a form on the forms list.-->
    <li class="tab <?php echo $tab[\Applications\EasyMvc\Resources\Enums\TaskTabKeys::CompleteTaskServicesTab]; ?>" id="tab7" data-form-id="live_task_services">
      <a href="<?php echo FrameworkConstants_BaseUrl . \Library\Enums\UrlKeys::CompleteTaskServices; ?>">
        <?php echo $resx["task_tab_services"]; ?>
      </a>
    </li>
  </ul>
