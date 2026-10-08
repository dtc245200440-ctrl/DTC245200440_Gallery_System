# Web Gallery System - Multi-Container Architecture

Hệ thống Web Gallery đa dịch vụ được đóng gói hoàn toàn bằng Docker Compose, tích hợp Nginx Reverse Proxy và hệ thống giám sát Prometheus + Grafana.

## 🏗 Cấu trúc Kiến trúc (Architecture)

- **Web Application**: PHP 8.1 Apache (`gallery_web`)
- **Database**: MySQL 8.0 (`gallery_db`)
- **Database Management**: phpMyAdmin (`gallery_phpmyadmin`)
- **Reverse Proxy & Security**: Nginx (`gallery_nginx`)
- **Monitoring & Metrics**: Prometheus (`gallery_prometheus`), Grafana (`gallery_grafana`), cAdvisor (`gallery_cadvisor`)

## 🚀 Hướng dẫn Khởi chạy (Deployment)

1. Yêu cầu máy tính đã cài đặt **Docker Desktop** và **Git**.
2. Clone repository về máy:
   ```bash
   git clone [https://github.com/dtc245200440-ctrl/DTC245200440_Gallery_System.git](https://github.com/dtc245200440-ctrl/DTC245200440_Gallery_System.git)
   cd DTC245200440_Gallery_System