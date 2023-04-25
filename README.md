<img src="https://automatorplugin.com/wp-content/uploads/2022/09/uncanny-automator-vertical-logo.svg" width="450px" />

# Uncanny Automator Pretty Links Integration 
### Requirements
- Uncanny Automator version 4.14 or above
- Pretty Links - https://wordpress.org/plugins/pretty-link/
- PHP 5.6 or above

Welcome to our public reference repository, which provides valuable insights and practical examples for building an integration with Uncanny Automator. Whether you're a seasoned developer or just starting out, this repository is an excellent resource to help you get up to speed with integration development.

To dive deeper into the integration development process, be sure to check out our comprehensive step-by-step guide. It provides a wealth of information on developing integrations for your plugins, as well as detailed instructions on how to create your own custom integration. You can find the guide here: https://developer.automatorplugin.com/create-a-custom-automator-integration/

We hope you find this repository and guide useful in your integration development endeavors. Happy coding!

### What are we building here?
#### Two Triggers

- A pretty link is created - A simple Trigger that listens when a pretty link is created.
- A pretty link of {{a specific redirect type}} is created - A Trigger that listend when a pretty link is created, but also allows us to select a redirect type.

#### Trigger tokens
`Pretty link ID`, `Redirect type`, `Name`, `Description`, `Pretty link URL`, `Slug`, `Tracking`, `Nofollow`, `Sponsored`
#### Action
We're adding an action that will automatically create a pretty link that generates an Action Token that we can use in any subsequent action(s).

- Create {{a pretty link}}
#### Action tokens
`Pretty link URL`, `Pretty link ID`

---
Check the source codes at /src directory to get started.