#!/bin/bash
#
# Docker Installation Script for Ubuntu/Debian
# This script automates the installation of Docker Engine and Docker Compose
#

set -e

# Print colored output
print_info() {
  echo -e "\e[34m[INFO]\e[0m $1"
}

print_success() {
  echo -e "\e[32m[SUCCESS]\e[0m $1"
}

print_warning() {
  echo -e "\e[33m[WARNING]\e[0m $1"
}

print_error() {
  echo -e "\e[31m[ERROR]\e[0m $1"
}

# Check if running as root
if [ "$(id -u)" -ne 0 ]; then
  print_error "This script must be run as root (use sudo)"
  exit 1
fi

print_info "Starting Docker installation process..."

# Detect OS
if [ -f /etc/os-release ]; then
  . /etc/os-release
  OS=$ID
  VERSION_CODENAME=$VERSION_CODENAME
else
  print_error "Unable to detect OS. This script supports Ubuntu and Debian."
  exit 1
fi

if [[ "$OS" != "ubuntu" && "$OS" != "debian" ]]; then
  print_error "This script supports Ubuntu and Debian only."
  exit 1
fi

print_info "Detected $OS $VERSION_CODENAME."

# Uninstall old versions
print_info "Removing old Docker versions (if any)..."
apt-get remove -y docker docker-engine docker.io containerd runc || true

# Update package index
print_info "Updating package index..."
apt-get update

# Install required packages
print_info "Installing required dependencies..."
apt-get install -y ca-certificates curl gnupg lsb-release apt-transport-https software-properties-common

# Add Docker's official GPG key
print_info "Adding Docker's official GPG key..."
install -m 0755 -d /etc/apt/keyrings
curl -fsSL https://download.docker.com/linux/$OS/gpg | gpg --dearmor -o /etc/apt/keyrings/docker.gpg
chmod a+r /etc/apt/keyrings/docker.gpg

# Set up the Docker repository
print_info "Setting up Docker repository..."
echo "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.gpg] https://download.docker.com/linux/$OS $VERSION_CODENAME stable" | tee /etc/apt/sources.list.d/docker.list > /dev/null

# Update package index again
print_info "Updating package index with new repository..."
apt-get update

# Install Docker Engine, containerd, and Docker Compose
print_info "Installing Docker Engine, containerd, and Docker Compose..."
apt-get install -y docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin

# Enable and start Docker service
print_info "Enabling and starting Docker service..."
systemctl enable docker
systemctl start docker

# Verify the installation
print_info "Verifying the installation..."
if docker run --rm hello-world > /dev/null 2>&1; then
  print_success "Docker has been successfully installed!"
else
  print_error "Docker installation verification failed."
  exit 1
fi

# Check if Docker Desktop should be installed
print_warning "IMPORTANT: Docker Desktop requires a Docker account. Make sure you have created and verified your account at https://hub.docker.com/"
read -p "Do you have a Docker account? (y/n): " have_account

if [[ "$have_account" =~ ^[Nn]$ ]]; then
  print_warning "Please create a Docker account before continuing with Docker Desktop installation."
  print_warning "Visit https://hub.docker.com/ to create an account and verify your email."
  read -p "Press Enter to continue once you have created and verified your Docker account, or Ctrl+C to exit..."
fi

# Ask if user wants to install Docker Desktop
read -p "Do you want to install Docker Desktop? (y/n): " install_desktop

if [[ "$install_desktop" =~ ^[Yy]$ ]]; then
  print_info "Starting Docker Desktop installation..."
  
  # Download Docker Desktop for Linux
  ARCH=$(dpkg --print-architecture)
  if [ "$ARCH" = "amd64" ]; then
    print_info "Downloading Docker Desktop for $OS $ARCH..."
    curl -L "https://desktop.docker.com/linux/main/amd64/docker-desktop-4.25.0-amd64.deb" -o /tmp/docker-desktop.deb
    
    # Install Docker Desktop
    print_info "Installing Docker Desktop..."
    apt-get install -y /tmp/docker-desktop.deb
    print_success "Docker Desktop has been installed!"
    print_info "You will need to sign in with your Docker account when you launch Docker Desktop."
  else
    print_error "Docker Desktop is only available for amd64 architecture."
  fi
fi

# Ask if user wants to add current user to docker group
read -p "Do you want to add your current user to the docker group? (y/n): " add_user

if [[ "$add_user" =~ ^[Yy]$ ]]; then
  # Get the username of the user who invoked sudo
  if [ -n "$SUDO_USER" ]; then
    USERNAME="$SUDO_USER"
  else
    read -p "Enter the username to add to docker group: " USERNAME
  fi
  
  if [ -n "$USERNAME" ]; then
    usermod -aG docker "$USERNAME"
    print_success "User $USERNAME added to docker group. Log out and log back in for changes to take effect."
    print_info "Alternatively, run 'newgrp docker' to apply changes in the current session."
  fi
fi

print_success "Docker installation complete!"
print_info "You can now use Docker on your system."
print_warning "IMPORTANT: Remember that Docker Hub and Docker Desktop features require a Docker account."
print_warning "Make sure your Docker account email is verified to avoid authentication issues."