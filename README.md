<img src="https://automatorplugin.com/wp-content/uploads/2022/09/uncanny-automator-vertical-logo.svg" width="450px" />

# Uncanny Automator Pretty Links Integration 

This repository serves as an example of how to build a new WordPress plugin integration for Uncanny Automator 4.14 or higher. Building an integration for Uncanny Automator is quite straightforward and will instantly allow plugins to connect with over 100 other plugins and apps in-no-code automations.

To slash development time (building an integration might only take a few hours), we recommend using this sample integration along with our comprehensive developer documentation. You can start with our developer documents for building a new integration here: https://developer.automatorplugin.com/create-a-custom-automator-integration/

We hope you find this repository and guide helpful in your integration development endeavors. Happy coding!

### What are we building here?
#### 3 Triggers

- A pretty link is created - A simple trigger that listens when a pretty link is created.
- A pretty link of {{a specific redirect type}} is created - A trigger that listens when a pretty link is created, but also allows us to select a redirect type.
- A pretty link of {{a specific redirect type}} is created <b>(with a token example)</b> - Same as the second trigger, but contains a sample token implemenation to demonstrate how to add tokens specific to Triggers (Trigger Tokens).

#### Trigger tokens
`Redirect ID` and `Redirect URL`
#### Action
We're adding an action that will automatically create a pretty link. This action will also add an "action" token that we can use in subsequent actions.

- Create a pretty link with {{a specific target URL}} - Simple action that automates the creation of pretty links.
- Create a pretty link with {{a specific target URL}} (with a token example) - Same as the previous one, but demonstates how you can add action tokens.
#### Action tokens
`Link ID`

### Requirements
- Uncanny Automator version 4.14 or above
- Pretty Links - https://wordpress.org/plugins/pretty-link/
- PHP 5.6 or above

---
Have a look at the source in /src to get started. If you run into issues or have questions, please reach out to our support team at support@automatorplugin.com.
