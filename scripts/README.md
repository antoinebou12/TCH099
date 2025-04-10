# Docker Installation Guide

This guide provides instructions for installing Docker, Docker Desktop, and Docker Compose on various operating systems.

## Table of Contents
- [Prerequisites](#prerequisites)
- [Creating a Docker Account](#creating-a-docker-account)
- [Installing Docker](#installing-docker)
  - [Ubuntu/Debian](#ubuntudebian)
  - [Windows](#windows)
  - [macOS](#macos)
- [Installing Docker Compose](#installing-docker-compose)
- [Installing Docker Desktop](#installing-docker-desktop)
- [Verifying Installation](#verifying-installation)
- [Troubleshooting](#troubleshooting)
- [Automated Installation](#automated-installation)

## Prerequisites

Before installing Docker, ensure your system meets the following requirements:

### Ubuntu/Debian
- 64-bit kernel and CPU support for virtualization
- Linux kernel version 3.10 or higher

### Windows
- Windows 10 64-bit: Pro, Enterprise, or Education (Build 18362 or later)
- Windows 11 64-bit: Home, Pro, Enterprise, or Education
- WSL2 and virtualization enabled
- 4GB system RAM

### macOS
- macOS 11 (Big Sur) or newer
- At least 4GB of RAM

## Creating a Docker Account

**⚠️ IMPORTANT: You must create a Docker account before using Docker Desktop and Docker Hub.**

1. Visit [Docker Hub](https://hub.docker.com/) and click "Sign Up"
2. Enter your email address, username, and password
3. **Check your email and verify your account by clicking the verification link**

Your Docker account is required for Docker Desktop and accessing Docker Hub.

## Installing Docker

### Ubuntu/Debian

Quick installation command:

```bash
sudo apt-get update && \
sudo apt-get install -y ca-certificates curl gnupg && \
sudo install -m 0755 -d /etc/apt/keyrings && \
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /etc/apt/keyrings/docker.gpg && \
sudo chmod a+r /etc/apt/keyrings/docker.gpg && \
echo "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.gpg] https://download.docker.com/linux/ubuntu $(. /etc/os-release && echo "$VERSION_CODENAME") stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null && \
sudo apt-get update && \
sudo apt-get install -y docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin
```

Add your user to the docker group:
```bash
sudo usermod -aG docker $USER
newgrp docker  # or log out and back in
```

### Windows

For Windows, install Docker Desktop which includes Docker Engine and Docker Compose:

1. Visit [Docker Desktop for Windows](https://docs.docker.com/desktop/install/windows-install/)
2. Download and run the installer
3. Follow the installation wizard

### macOS

For macOS, install Docker Desktop which includes Docker Engine and Docker Compose:

1. Visit [Docker Desktop for Mac](https://docs.docker.com/desktop/install/mac-install/)
2. Download the appropriate version for your Mac (Intel or Apple Silicon)
3. Open the downloaded `.dmg` file and drag Docker to Applications

## Installing Docker Compose

Docker Compose is included with Docker Desktop. For Linux without Docker Desktop:

```bash
sudo curl -L "https://github.com/docker/compose/releases/download/v2.20.3/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose && \
sudo chmod +x /usr/local/bin/docker-compose
```

## Installing Docker Desktop

1. Create and verify your Docker account first at [Docker Hub](https://hub.docker.com/)
2. Download Docker Desktop for your platform:
   - [Windows](https://docs.docker.com/desktop/install/windows-install/)
   - [macOS](https://docs.docker.com/desktop/install/mac-install/)
   - [Linux](https://docs.docker.com/desktop/install/linux-install/)
3. Install and launch the application
4. Sign in with your Docker account when prompted

## Verifying Installation

```bash
docker --version
docker run hello-world
docker-compose --version
```

## Troubleshooting

1. **Permission denied error:**
   ```bash
   sudo usermod -aG docker $USER
   newgrp docker  # or log out and log back in
   ```

2. **Docker daemon not running:**
   ```bash
   sudo systemctl start docker
   ```

3. **WSL 2 issues on Windows:**
   - Enable WSL 2 in Windows features
   - Update WSL 2 kernel with: `wsl --update`

## Automated Installation

Use our automated installation script for Ubuntu/Debian systems:

```bash
curl -fsSL https://raw.githubusercontent.com/yourusername/docker-install/main/install-docker.sh -o install-docker.sh
chmod +x install-docker.sh
sudo ./install-docker.sh
```

The script will:
- Install Docker Engine and Docker Compose
- Optionally install Docker Desktop
- Add your user to the docker group
- Remind you about creating and verifying your Docker account

**Remember:** Docker requires a Docker account for using Docker Desktop and Docker Hub features. Make sure to create an account at [Docker Hub](https://hub.docker.com/) and verify your email before using Docker Desktop.