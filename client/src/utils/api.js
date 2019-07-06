import request, { inRequest, requestFiles, localRequest} from './request'

const api = {
    getNovelty() {
        return request('get', `/Zhihu/zhihu_daily`);
    },
    getTagOneList(params = {type: 0, page:5}) {
        //return request('get', `/News/new_list?type=${type}&page=${start}`, params);
        return request('get', `/News/new_list`, params = params);
    },
    getTagTwoList(city="广州市", page=0){
        return request('get', `/News/local_news?name=广东省_${city}&page=${page}`);
    },
    getTagThreeList() {
        return request('get', `/Video/index`);
    },
    getTagFourList() {
        return request();
    },
    getTagFiveList(start = 0) {
        return request('get', `/Movie/playing_movie_list?start=${start}&count=9`)
    },
    getTag1Detail(id){
        return request('get', `/News/new_detail?postid=${id}`)
    },
    getTag3Detail(id){
        return request('get', `/Zhihu/news?id=${id}`)
    },
    addUserVp(options){
        return requestFiles(options);
    },
    registerUser(params){
        return localRequest('post', '/controller/register.php', params);
    },
    login(params){
        return localRequest('post', '/controller/login.php', params);
    },
    logout(){
        return localRequest('get', '/controller/quit.php');
    },
    getUserIndexMsg(){
        return localRequest('get', '/controller/mainShow.php');
    },
    getUserHomeMsg(){
        return localRequest('post', '/controller/personMessage.php');
    },
    getUserTypeMsg(params){
        return localRequest('post', '/controller/typeShow.php', params);
    },
    addUserProfile(options){
        return requestFiles(options);
    },
    getUserAlbum(){
        return localRequest('get', '/controller/personPicture.php')
    }
    
}

export {
    api
}