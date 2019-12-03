<?php
class PluginRoleFlash{
  public function widget_show($data){
    /**
     * Get roles.
     */
    $roles = wfGlobals::get('settings/role/item');
    if(!$roles){
      exit('No roles are set in theme settings.yml file.');
    }
    /**
     * Handle has_role.
     */
    foreach ($roles as $key => $value) {
      $i = new PluginWfArray($value);
      if(wfUser::hasRole($i->get('name'))){
        $roles[$key]['has_role'] = 'Yes';
      }else{
        $roles[$key]['has_role'] = 'No';
      }
    }
    /**
     * Set keys.
     */
    $temp = array();
    foreach ($roles as $key => $value) {
      $i = new PluginWfArray($value);
      $temp[$i->get('name')] = $value;
    }
    $roles = $temp;
    /**
     * Add extra roles not registrated.
     */
    if(wfUser::getSession()->get('role')){
      foreach (wfUser::getSession()->get('role') as $value) {
        if(!array_key_exists($value, $roles)){
          $roles[$value] = array('name' => $value, 'description' => '(not registrated)', 'has_role' => 'Yes');
        }
      }
    }
    /**
     * 
     */
    wfPlugin::includeonce('wf/yml');
    wfPlugin::enable('wf/table');
    /**
     * Get element.
     */
    $element = new PluginWfYml(__DIR__.'/element/table.yml');
    /**
     * Set data.
     */
    $element->setByTag(array('data' => $roles));
    /**
     * 
     */
    wfDocument::renderElement(array($element->get()));
  }
}
