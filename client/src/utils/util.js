

function fixPic403(url) {
    if (url !== undefined) {
        return url.replace(/^(http)[s]*(\:\/\/)/, 'https://images.weserv.nl/?url=');
    }
}

function fixDate(date) {
    if(date !== ''){
        const year = date.substring(0, 4);
        const month = date.substring(4,6);
        const day = date.substring(6,8);
        return `${year}-${month}-${day}`
    }
    
}

function fixArrFormatStr (arr) {
    if(arr.constructor === Array){
        return arr.join("/")
    }
}

function fixFormatArticle(data){
    

}

export default{
    fixPic403,
    fixDate,
    fixArrFormatStr,
    fixFormatArticle
}