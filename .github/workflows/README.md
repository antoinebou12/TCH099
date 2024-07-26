## README

### Overview

This repository contains two separate workflows:

1. **Deploy a PHP app to Azure Web App**
2. **Deploy static content to GitHub Pages**

### Prerequisites

For Azure deployment, ensure you have:
- An Azure account with an App Service created.
- The following secrets added to the GitHub repository:
  - `AZUREAPPSERVICE_CLIENTID`
  - `AZUREAPPSERVICE_TENANTID`
  - `AZUREAPPSERVICE_SUBSCRIPTIONID`

### Workflow 1: Deploy PHP App to Azure Web App

This workflow builds and deploys a PHP application to an Azure Web App.

#### Trigger

- On push to the `main` branch.
- Manually triggered via the Actions tab.

#### Jobs

1. **Build**

   - **Runs on**: `ubuntu-latest`

   **Steps:**
   - Checkout the code.
   - Setup PHP.
   - Check for `composer.json`.
   - Install dependencies if `composer.json` is found.
   - Zip the project, excluding the `MyMobileApp` directory.
   - Upload the zip file as an artifact.

2. **Deploy**

   - **Runs on**: `ubuntu-latest`
   - **Environment**: `Production`

   **Steps:**
   - Download the artifact from the build job.
   - Unzip the artifact.
   - Login to Azure using credentials stored in secrets.
   - Deploy the unzipped content to the Azure Web App.

### Workflow 2: Deploy Static Content to GitHub Pages

This workflow deploys static content to GitHub Pages.

#### Trigger

- On push to the `main` branch.
- Manually triggered via the Actions tab.

#### Job

**Deploy**

- **Runs on**: `ubuntu-latest`
- **Environment**: `github-pages`

**Steps:**
- Checkout the code.
- Setup GitHub Pages.
- Upload the `/docs` directory as an artifact.
- Deploy the artifact to GitHub Pages.

### How to Use

1. **Azure Deployment**
   - Ensure the necessary secrets are configured in your GitHub repository.
   - Push changes to the `main` branch or manually trigger the workflow.

2. **GitHub Pages Deployment**
   - Push changes to the `main` branch or manually trigger the workflow.

### References

- [Azure Web Apps Deploy Action](https://github.com/Azure/webapps-deploy)
- [GitHub Actions for Azure](https://github.com/Azure/actions)
