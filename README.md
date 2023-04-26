<img src="https://automatorplugin.com/wp-content/uploads/2022/09/uncanny-automator-vertical-logo.svg" width="450px" />

# Uncanny Automator Pretty Links Integration 

This repository serves as an example of how to build an integration for your plugin. The integration here uses Pretty Links as a sample plugin. Integrating your plugin with Automator means your plugin will be ready to communicate with other plugins, including popular ones like WooCommerce, or even communicate with external apps such as MailChimp, WhatsApp, or Google Sheets.

To dive deeper into the integration development process, be sure to check out our comprehensive, step-by-step guide. It provides a wealth of information on developing integrations for your plugins, as well as detailed instructions on creating your custom integration. You can find the guide here: https://developer.automatorplugin.com/create-a-custom-automator-integration/

We hope you find this repository and guide helpful in your integration development endeavors. Happy coding!

### What are we building here?
#### 3 Triggers

- A pretty link is created - A simple Trigger that listens when a pretty link is created.
- A pretty link of {{a specific redirect type}} is created - A Trigger that listend when a pretty link is created, but also allows us to select a redirect type.
- A pretty link of {{a specific redirect type}} is created <b>(with tokens example)</b> - Same as the second Trigger mentioned, but contains a sample Tokens implemenation to demonstrate how to add tokens specific to Triggers (Trigger Tokens).

#### Trigger tokens
`Redirect ID` and `Redirect URL`
#### Action
We're adding an action that will automatically create a pretty link that generates an Action Token that we can use in any subsequent action(s).

- Create {{a pretty link}}
#### Action tokens
`Pretty link URL`, `Pretty link ID`

### Requirements
- Uncanny Automator version 4.14 or above
- Pretty Links - https://wordpress.org/plugins/pretty-link/
- PHP 5.6 or above

---
Check the source codes at /src directory to get started.