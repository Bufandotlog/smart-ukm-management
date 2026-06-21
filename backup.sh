#!/bin/bash
# ==============================================================================
# SCRIPT BACKUP MANUAL (JALANKAN DI LAPTOP PRIBADI)
# ==============================================================================
# Script ini akan:
# 1. Menghubungi VPS via SSH (port 22022) untuk memicu mysqldump di container MariaDB.
# 2. Mengunduh kode aplikasi beserta database dump terbaru via rsync.
# 3. Menghapus file dump sementara di VPS demi keamanan.

VPS_IP="157.15.124.146"
VPS_PORT="22022"
VPS_USER="bufan"
VPS_PATH="/var/www/html/organisasi"
LOCAL_PATH="$HOME/vps-backup/UKM"

echo "=================================================="
echo " Starting Manual Backup: VPS -> Laptop"
echo "=================================================="

# 1. Memicu dump database di VPS
echo "👉 [1/3] Membuat database dump di VPS..."
ssh -p $VPS_PORT $VPS_USER@$VPS_IP "docker exec ukm_db sh -c 'exec mysqldump -u\"\$DB_USER\" -p\"\$DB_PASS\" \"\$DB_NAME\"' > $VPS_PATH/database/backup.sql"

if [ $? -eq 0 ]; then
    echo "✔ Database dump berhasil dibuat di VPS."
else
    echo "❌ Gagal membuat database dump di VPS."
    exit 1
fi

# 2. Sinkronisasi data ke laptop
echo "👉 [2/3] Menyinkronkan file aplikasi & database ke Laptop..."
mkdir -p "$LOCAL_PATH"
rsync -avzh --delete --exclude='.git' -e "ssh -p $VPS_PORT" $VPS_USER@$VPS_IP:$VPS_PATH/ "$LOCAL_PATH/"

if [ $? -eq 0 ]; then
    echo "✔ Sinkronisasi file selesai."
else
    echo "❌ Gagal menyinkronkan file."
fi

# 3. Membersihkan dump di VPS
echo "👉 [3/3] Menghapus file dump sementara di VPS..."
ssh -p $VPS_PORT $VPS_USER@$VPS_IP "rm -f $VPS_PATH/database/backup.sql"

echo "=================================================="
echo " Backup Selesai! Data disimpan di: $LOCAL_PATH"
echo "=================================================="
