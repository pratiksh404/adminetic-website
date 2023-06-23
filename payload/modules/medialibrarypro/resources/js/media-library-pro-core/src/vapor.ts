import { AxiosRequestConfig, CancelToken } from 'axios';
import { api } from './api';

type Options = {
    signedStorageUrl: string;
    bucket?: string;
    contentType?: string;
    expires?: string;
    visibility?: string;
    baseURL?: string;
    headers?: string;
    cancelToken?: CancelToken;
    options?: AxiosRequestConfig;
    withCredentials: boolean;
    onUploadProgress?: (progressEvent: ProgressEvent) => void;
};

// original by Taylor Otwell: https://github.com/laravel/vapor-js

/**
 * Store a file in S3 and return its UUID, key, and other information.
 */
export default async function vaporUpload(
    file: File,
    options: Options = { signedStorageUrl: '/vapor/signed-storage-url', withCredentials: true }
) {
    const response = await api.post(
        options.signedStorageUrl,
        {
            bucket: options.bucket || '',
            content_type: options.contentType || file.type,
            expires: options.expires || '',
            visibility: options.visibility || '',
        },
        {
            withCredentials: options.withCredentials,
            baseURL: options.baseURL || undefined,
            headers: options.headers || {},
            ...options.options,
        }
    );

    let headers = response.data.headers;

    if ('Host' in headers) {
        delete headers.Host;
    }

    const cancelToken = options.cancelToken || undefined;

    await api.put(response.data.url, file, {
        withCredentials: options.withCredentials,
        cancelToken: cancelToken,
        headers: headers,
        onUploadProgress: options.onUploadProgress,
    });

    response.data.extension = file.name.split('.').pop();

    return response.data;
}
