import en from './langs/en.json';
import ru from './langs/ru.json';

export const defaultLocale = localStorage.getItem('lang') ?? 'ru';

export const languages = {
    en, ru
};
