# Uncanny AutomatorPretty Links Integration 
### Requirements
- Uncanny Automator version 4.14 or above
- PHP 5.6 or above
- Tested up to WordPress 6.2

This repository serves as a public reference and example for building and integration for Uncanny Automator. For full documentation, please visit our step by step guide on how to build your own integration or an integration for your plugin: https://developer.automatorplugin.com/create-a-custom-automator-integration/

This example does implement a basic feature. The sample codes provided in this repo does not serve as an official way of integrating with Uncanny Automator. 

There are tons of ways to handle the integration, but the most important part is to extend the parent classes.

<table>
<tr>
  <th>Object type</th>
  <th>Parent class</th>
</tr>
<tr>
  <td>Integration</td>
  <td>\Uncanny_Automator\Integration</td>
</tr>
<tr>
  <td>Trigger</td>
  <td>\Uncanny_Automator\Recipe\Trigger</td>
</tr>
<tr>
  <td>Action</td>
  <td>\Uncanny_Automator\Recipe\Action</td>
</tr>
</table>
