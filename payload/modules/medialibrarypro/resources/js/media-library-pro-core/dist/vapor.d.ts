import { AxiosRequestConfig, CancelToken } from 'axios';
declare type Options = {
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
/**
 * Store a file in S3 and return its UUID, key, and other information.
 */
export default function vaporUpload(file: File, options?: Options): Promise<any>;
export {};
