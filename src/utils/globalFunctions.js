// src/utils/globalFunctions.js
import { format, isValid, parseISO } from 'date-fns';
import { id } from "date-fns/locale";
import Toastify from 'toastify-js';
import Swal from 'sweetalert2';
import "toastify-js/src/toastify.css";

export function formatTanggal(tanggal) {
    return format(new Date(tanggal), "dd MMMM yyyy HH:mm:ss", {
        locale: id,
    });
}

export function formatTanggalsaja(tanggal) {
    if (!tanggal) {
        return ""; // Return empty string if tanggal is not provided
    }

    const parsedDate = parseISO(tanggal);

    if (!isValid(parsedDate)) {
        return "Invalid date"; // You can return a default value or message
    }

    return format(parsedDate, "d MMMM yyyy", { locale: id });
}

export function truncateText(text, length) {
    if (text.length <= length) {
        return text;
    }
    return text.substring(0, length) + "...";
}

export function formatRupiah(angka, prefix = '') {
    const numberString = angka.toString().replace(/[^,\d]/g, '');
    const split = numberString.split(',');
    let sisa = split[0].length % 3;
    let rupiah = split[0].substr(0, sisa);
    const ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        const separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix + rupiah;
}

export function thnsekarang(){
    return new Date().getFullYear();
}

export function getEmbedUrl(url){
    const videoId = url.split('v=')[1];
    const ampersandPosition = videoId.indexOf('&');
    if(ampersandPosition !== -1) {
        return `https://www.youtube.com/embed/${videoId.substring(0, ampersandPosition)}`;
    }
    return `https://www.youtube.com/embed/${videoId}`;
}

export function showToast(message, backgroundColor = "#4fbe87", duration = 3000, position = "right", gravity = "top") {
    Toastify({
        text: message,
        duration: duration,
        close: true,
        gravity: gravity,
        position: position,
        style: {
            background: backgroundColor,
        },
    }).showToast();
}

export const showAlert = (title, text, icon = 'info', confirmButtonText = 'OK') => {
    return Swal.fire({
      title: title,
      text: text,
      icon: icon,
      confirmButtonText: confirmButtonText,
    });
};

export const confirmDelete = async (title = 'Apakah kamu yakin?', text = 'Data ini akan dihapus!') => {
    return Swal.fire({
      title: title,
      text: text,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#f06548',
      cancelButtonColor: '#405189',
      confirmButtonText: 'Hapus',
      cancelButtonText: 'Batal',
    });
  };
