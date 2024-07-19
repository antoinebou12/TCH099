variable "resource_group_name" {
  description = "The name of the resource group in which to create the resources."
  default     = "example-resources"
}

variable "location" {
  description = "The Azure location where the resources will be created."
  default     = "Canada Central"
}

variable "storage_account_name" {
  description = "The name of the storage account."
  default     = "examplestorageacct"
}

variable "container_registry_name" {
  description = "The name of the Azure Container Registry."
  default     = "exampleregistry"
}

variable "mysql_server_name" {
  description = "The name of the MySQL server."
  default     = "example-mysql-server"
}

variable "mysql_admin_username" {
  description = "The administrator username for the MySQL server."
  default     = "mysqladmin"
}

variable "mysql_admin_password" {
  description = "The administrator password for the MySQL server."
  default     = "Password123!"
  sensitive   = true
}

variable "mysql_database_name" {
  description = "The name of the MySQL database."
  default     = "exampledb"
}

variable "container_group_name" {
  description = "The name of the container group."
  default     = "example-container-group"
}

variable "container_name" {
  description = "The name of the container."
  default     = "example-container"
}

variable "container_image" {
  description = "The Docker image to use for the container."
  default     = "yourdockerimage:latest"
}

variable "container_cpu" {
  description = "The amount of CPU to allocate to the container."
  default     = "0.5"
}

variable "container_memory" {
  description = "The amount of memory to allocate to the container."
  default     = "1.5"
}

variable "environment" {
  description = "The environment for the deployment."
  default     = "testing"
}
