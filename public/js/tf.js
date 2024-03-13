const TF_LANG = {
    'ru': {
        'seconds': ['секунду', 'секунды', 'секунд'],
        'minutes': ['минуту', 'минуты', 'минут'],
        'hours': ['час', 'часа', 'часов'],
        'days': ['воскресенье в', 'понедельник в', 'вторник в', 'среду в', 'четверг в', 'пятницу в', 'субботу в'],
        'last': ['в прошлое', 'в прошлый', 'в прошлый', 'в прошлую', 'в прошлый', 'в прошлую', 'в прошлую'],
        'now': 'прямо сейчас',
        'ago': 'назад',
        'today': 'сегодня в',
        'yesterday': 'вчера в',
        'at': 'в', 'tomorrow': 'завтра',
        'in': 'через'
    }
};

const TF_GET_LANG = () => {
    return document.querySelector('body') != null ? (document.querySelector('body').getAttribute('tf-lang') != null ? document.querySelector('body').getAttribute('tf-lang') : false) : false
};

const TF_FORMAT = (a, b) => {
    a = Math.abs(a) % 100;
    let c = a % 10;
    return 10 < a && 20 > a ? b[2] : 1 < c && 5 > c ? b[1] : 1 === c ? b[0] : b[2]
};

const TF_SL = (num) => {
    return (`0${num}`).slice(-2)
};

const TF_PROCESS = async (selector = '.tf-format') => {
    try {
        const all_elems = document.querySelectorAll(selector);
        const current_time = Math.floor(Date.now() / 1000);
        const date = new Date;
        const start = new Date(date.getFullYear(), date.getMonth(), date.getDate());
        const language = TF_LANG[TF_GET_LANG() == null ? 'ru' : (typeof TF_LANG[TF_GET_LANG()] == 'object' ? TF_GET_LANG() : 'ru')];
        for (const elem of all_elems) {
            try {
                const unix = parseInt(elem.getAttribute('tf-unix'));
                if (isNaN(unix)) continue;
                const u_date = new Date(unix * 1000);
                let diff = current_time - unix;
                let unix_text;
                if (diff > 0) {
                    if (diff <= 15) unix_text = language.now;
                    else if (diff >= 15 && diff < 60) unix_text = `${diff} ${TF_FORMAT(diff, language.seconds)} ${language.ago}`;
                    else if (diff >= 60 && diff < 3600) unix_text = `${Math.floor(diff / 60)} ${TF_FORMAT(Math.floor(diff / 60), language.minutes)} ${language.ago}`;
                    else if (diff >= 3600 && diff < 21600) unix_text = `${Math.floor(diff / 60 / 60)} ${TF_FORMAT(Math.floor(diff / 60 / 60), language.hours)} ${language.ago}`;
                    else if (date.getMonth() === u_date.getMonth() && date.getYear() === u_date.getYear() && date.getDate() === u_date.getDate()) unix_text = `${language.today} ${TF_SL(u_date.getHours())}:${TF_SL(u_date.getMinutes())}`;
                    else if (u_date.getTime() < start.getTime() && Math.floor((start.getTime() - u_date.getTime()) / 1000) < 86400) unix_text = `${language.yesterday} ${TF_SL(u_date.getHours())}:${TF_SL(u_date.getMinutes())}`;
                    else if (u_date.getTime() < start.getTime() && Math.floor((start.getTime() - u_date.getTime()) / 1000) < (86400 * 7)) unix_text = `${language.last[u_date.getDay()]} ${language.days[u_date.getDay()]} ${TF_SL(u_date.getHours())}:${TF_SL(u_date.getMinutes())}`;
                    else unix_text = `${TF_SL(u_date.getDate())}.${TF_SL(u_date.getMonth())}.${TF_SL(u_date.getFullYear())} ${language.at} ${TF_SL(u_date.getHours())}:${TF_SL(u_date.getMinutes())}`;
                } else {
                    diff = Math.abs(diff);
                    if (diff <= 15) unix_text = language.now;
                    else if (diff >= 15 && diff < 60) unix_text = `${language.in} ${diff} ${TF_FORMAT(diff, language.seconds)}`;
                    else if (diff >= 60 && diff < 3600) unix_text = `${language.in} ${Math.floor(diff / 60)} ${TF_FORMAT(Math.floor(diff / 60), language.minutes)}`;
                    else if (diff >= 3600 && diff < 21600) unix_text = `${language.in} ${Math.floor(diff / 60 / 60)} ${TF_FORMAT(Math.floor(diff / 60 / 60), language.hours)}`;
                    else if (date.getMonth() === u_date.getMonth() && date.getYear() === u_date.getYear() && date.getDate() === u_date.getDate()) unix_text = `${language.today} ${TF_SL(u_date.getHours())}:${TF_SL(u_date.getMinutes())}`;
                    else if (u_date.getTime() > start.getTime() && Math.floor((u_date.getTime() - start.getTime()) / 1000) > 86400) unix_text = `${language.tomorrow} ${TF_SL(u_date.getHours())}:${TF_SL(u_date.getMinutes())}`;
                    else if (u_date.getTime() > start.getTime() && Math.floor((u_date.getTime() - start.getTime()) / 1000) > (86400 * 7)) unix_text = `${language.days[u_date.getDay()]} ${TF_SL(u_date.getHours())}:${TF_SL(u_date.getMinutes())}`;
                    else unix_text = `${TF_SL(u_date.getDate())}.${TF_SL(u_date.getMonth())}.${TF_SL(u_date.getFullYear())} ${language.at} ${TF_SL(u_date.getHours())}:${TF_SL(u_date.getMinutes())}`;
                }
                elem.innerHTML = unix_text;
            } catch (err) {
                console.log(err);
            }
        }
    } catch (err) {
        console.log(err);
    }
};

setInterval(() => TF_PROCESS(), 100);
