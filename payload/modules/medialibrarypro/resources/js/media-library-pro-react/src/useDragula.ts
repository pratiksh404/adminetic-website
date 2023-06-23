import * as React from 'react';
import Dragula from 'react-dragula';
import { Drake } from 'dragula';

export default function useDragula(handleClass?: string) {
    const [drake, setDrake] = React.useState<Drake | null>(null);

    const dragulaDecorator = React.useCallback(
        (container: HTMLDivElement | null) => {
            if (container) {
                setDrake(
                    Dragula([container], {
                        moves: handleClass
                            ? (_el, _container, handle) => {
                                  if (!handle) {
                                      return false;
                                  }

                                  return Boolean(handle.closest('.' + handleClass));
                              }
                            : undefined,
                    })
                );
            }
        },
        [Dragula]
    );

    return { dragulaDecorator, drake };
}
