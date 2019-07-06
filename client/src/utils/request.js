import axios from 'axios'
import qs from 'qs' // 引入qs
import { Loading, Message } from 'element-ui'
// 一些请求的基本配置 
const service = axios.create({
    baseURL: "/isoyu",// 接口的域名地址  
    timeout: 5000,
    withCredentials: true,
    headers: { 'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8' }
})

const files = axios.create({
    baseURL: "/vp",// 接口的域名地址  
    timeout: 5000,
    withCredentials: true,
    headers: { 'Content-Type': 'application/form-data;' }
})

const localService = axios.create({
    baseURL: "/vp",// 接口的域名地址  
    timeout: 5000,
    withCredentials: true,
    //headers: { 'Content-Type': 'application/x-www-form-urlencoded;' }
})



var loadinginstace;
// 请求拦截（配置请求回来的信息）
service.interceptors.request.use(config => {
    // element ui Loading方法
    //loadinginstace = Loading.service({ fullscreen: true })
    return config
}, error => {
    //loadinginstace.close()
    Message.error({
        message: '加载超时'
    })
    return Promise.reject(error)
})
// 响应拦截（配置请求回来的信息）
service.interceptors.response.use(function (response) {
    // 处理响应数据
    //loadinginstace.close()
    return response;
}, function (err) {
    // 处理响应失败
    console.log(err.status)
    var config = err.config;
    // If config does not exist or the retry option is not set, reject
    if (!config || !config.retry) return Promise.reject(err);

    // Set the variable for keeping track of the retry count
    config.__retryCount = config.__retryCount || 0;

    // Check if we've maxed out the total number of retries
    if (config.__retryCount >= config.retry) {
        // Reject with the error
        return Promise.reject(err);
    }

    // Increase the retry count
    config.__retryCount += 1;

    // Create new promise to handle exponential backoff
    var backoff = new Promise(function (resolve) {
        setTimeout(function () {
            resolve();
        }, config.retryDelay || 1);
    });

    // Return the promise in which recalls axios to retry the request
    return backoff.then(function () {
        return axios(config);
    });

});


export default function request(method = 'post', url, params = {}) {
    return new Promise((resolve, reject) => {
        const options = {
            url,
            method,
            params
        }
        service(options)
            .then(res => {
                resolve(res.data)
            })
            .catch(err => {
                reject(err)
            })
    })
}

export function inRequest(method = 'post', url, params = {}) {
    return new Promise((resolve, reject) => {
        const options = {
            url,
            method,
            params
        }
        service(options)
            .then(res => {
                console.log(res)
                let items = res.data.data;
                let num1 = items.indexOf("(");
                let num2 = items.indexOf(")");
                let resData = JSON.parse(items.substring(num1 + 1, num2));
                resolve(resData)
            })
            .catch(err => {
                reject(err)
            })
    })
}

export function requestFiles(options) {
    options.method = 'post'
    options.dataType = 'json'
    //console.log(qs.stringify(options.data))
    if (options.config === 'formData') {
        options.headers = { 'Content-Type': 'multipart/form-data' }
    }
    return new Promise((resolve, reject) => {
        files(options).then(res => {
            resolve(res)
        }).catch(error => {
            // 显示拦截器对respone处理后的可读错误
            //this.$message.error(`${error.code} : ${error.message}`)
            console.log(error)
            reject(error);
        })
    })
}

export function localRequest(method, url, params) {
    let options = {
        url,
        method,
        data: params,
        dataType: 'json'
    }
    if(options.data){
        options.data = qs.stringify(options.data)
    }
    return new Promise((resolve, reject) => {
        localService(options).then(res => {
            resolve(res)
        }).catch(error => {
            reject(error);
        })
    })
}
